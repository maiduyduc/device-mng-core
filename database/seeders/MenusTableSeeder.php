<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    private $menuId = null;
    private $dropdownId = array();
    private $dropdown = false;
    private $sequence = 1;
    private $joinData = array();
    private $adminRole = null;
    private $ktvRole = null;
    private $ptbRole = null;
    private $trkRole = null;
    private $subFolder = '';

    public function join($roles, $menusId){
        $roles = explode(',', $roles);
        foreach($roles as $role){
            array_push($this->joinData, array('role_name' => $role, 'menus_id' => $menusId));
        }
    }

    /*
        Function assigns menu elements to roles
        Must by use on end of this seeder
    */
    public function joinAllByTransaction(){
        DB::beginTransaction();
        foreach($this->joinData as $data){
            DB::table('menu_role')->insert([
                'role_name' => $data['role_name'],
                'menus_id' => $data['menus_id'],
            ]);
        }
        DB::commit();
    }

    public function insertLink($roles, $name, $href, $icon = null){
        $href = $this->subFolder . $href;
        if($this->dropdown === false){
            DB::table('menus')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'sequence' => $this->sequence
            ]);
        }else{
            DB::table('menus')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'parent_id' => $this->dropdownId[count($this->dropdownId) - 1],
                'sequence' => $this->sequence
            ]);
        }
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        $permission = Permission::where('name', '=', $name)->get();
        if(empty($permission)){
            $permission = Permission::create(['name' => 'visit ' . $name]);
        }
        $roles = explode(',', $roles);
        if(in_array('admin', $roles)){
            $this->adminRole->givePermissionTo($permission);
        }
        if(in_array('ktv', $roles)){
            $this->ktvRole->givePermissionTo($permission);
        }
        if(in_array('ptb', $roles)){
            $this->ptbRole->givePermissionTo($permission);
        }
        if(in_array('trk', $roles)){
            $this->trkRole->givePermissionTo($permission);
        }
        return $lastId;
    }

    public function insertTitle($roles, $name){
        DB::table('menus')->insert([
            'slug' => 'title',
            'name' => $name,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence
        ]);
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        return $lastId;
    }

    public function beginDropdown($roles, $name, $icon = ''){
        if(count($this->dropdownId)){
            $parentId = $this->dropdownId[count($this->dropdownId) - 1];
        }else{
            $parentId = null;
        }
        DB::table('menus')->insert([
            'slug' => 'dropdown',
            'name' => $name,
            'icon' => $icon,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence,
            'parent_id' => $parentId
        ]);
        $lastId = DB::getPdo()->lastInsertId();
        array_push($this->dropdownId, $lastId);
        $this->dropdown = true;
        $this->sequence++;
        $this->join($roles, $lastId);
        return $lastId;
    }

    public function endDropdown(){
        $this->dropdown = false;
        array_pop( $this->dropdownId );
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Get roles */
        $this->adminRole = Role::where('name' , '=' , 'admin' )->first();
        $this->ktvRole = Role::where('name', '=', 'ktv' )->first();
        $this->ptbRole = Role::where('name', '=', 'ptb' )->first();
        $this->trkRole = Role::where('name', '=', 'trk' )->first();
        /* Create Sidebar menu */
        DB::table('menulist')->insert([
            'name' => 'sidebar menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        $this->insertLink('ktv,ptb,trk,admin',      'Trang chủ',           '/', 'mdi mdi-home');
        //===========================================================================================
        //Quản lý cấp phát
        $this->beginDropdown('ktv,ptb,trk',   'Quản lý cấp phát',    'bx bx-edit');
            $this->insertLink('ktv',          'Lập dự trù',               '/device-plan');
            $this->insertLink('ptb,trk',      'Nhận dự trù',              '/device-plan');
            //Nhập thiết bị: ktv được phép thao tác: xem, thêm, sửa, xóa | ptb & trk chỉ được xem
            $this->insertLink('ktv,ptb,trk',  'Nhập thiết bị',            '/document');
            $this->insertLink('ptb,trk',      'Bàn giao thiết bị',        '/handover');
            $this->insertLink('ktv',          'Nhận bàn giao',            '/handover');
        $this->endDropdown();
        //================
        //Quản lý kiểm kê
        $this->beginDropdown('ktv,ptb,trk',   'Kiểm kê',             'mdi mdi-clipboard-text-outline');
            $this->insertLink('ktv,ptb,trk',  'Kiểm kê trên máy',         '/developing');
            $this->insertLink('ktv,ptb,trk',  'Kiểm kê trên sổ',          '/developing');
        $this->endDropdown();
        //================
        //Theo dõi
        $this->beginDropdown('ktv,ptb,trk',   'Theo dõi',            'mdi mdi-eye');
            $this->insertLink('ktv,ptb,trk',  'Nhật ký thiết bị',          '/history');
            $this->insertLink('ktv,ptb,trk',  'Tổng hợp thanh lý',         '/liquidate');
        $this->endDropdown();
        //================
        //Tìm kiếm, báo cáo
        $this->beginDropdown('ktv,ptb,trk',   'Tìm kiếm, Báo cáo',   'mdi mdi-book-search-outline');
            $this->insertLink('ktv,ptb,trk',  'Tìm kiếm',                  '/developing');
            $this->insertLink('ktv',  'Lập báo cáo',               '/developing');
        $this->endDropdown();
        //================

        //Quản trị hệ thống
        $this->insertTitle('admin', 'CHỨC NĂNG DÀNH RIÊNG CHO AMDIN');
        $this->beginDropdown('admin,ktv',   'Quản lý hệ thống', 'bx bx-chip');
            $this->insertLink('admin',      'Quản lý người dùng',      '/users');
            $this->insertLink('admin',      'Quản lý vai trò',         '/roles');
            $this->insertLink('admin',      'Quản lý menu chính',      '/menu/menu');
            $this->insertLink('admin',      'Quản lý menu con',        '/menu/element');
            $this->insertLink('ktv',        'Quản lý phòng',           '/room');
            $this->insertLink('ktv,admin',  'Sao lưu, phục hồi',       '/developing');
            $this->beginDropdown('ktv',     'Quản lý thiết bị');
                $this->insertLink('ktv',    'Danh mục thiết bị',       '/category-device');
                $this->insertLink('ktv',    'Danh sách thiết bị',      '/device');
            $this->endDropdown();
        $this->endDropdown();
        //================

        //Đăng xuất
        $this->insertLink('ktv,ptb,trk,admin', 'Đăng xuất', '/dangxuat', 'mdi mdi-logout');

        $this->joinAllByTransaction(); ///   <===== Must by use on end of this seeder
    }
}
