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
    private $SadminRole = null;
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
        $this->SadminRole = Role::where('name' , '=' , 'sadmin' )->first();
        $this->adminRole = Role::where('name' , '=' , 'admin' )->first();
        $this->ktvRole = Role::where('name', '=', 'ktv' )->first();
        $this->ptbRole = Role::where('name', '=', 'ptb' )->first();
        $this->trkRole = Role::where('name', '=', 'trk' )->first();
        /* Create Sidebar menu */
        DB::table('menulist')->insert([
            'name' => 'sidebar menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        $this->insertLink('ktv,ptb,trk,admin,sadmin',      'Trang ch???',           '/', 'mdi mdi-home');
        //===========================================================================================
        //Qu???n l?? c???p ph??t
        $this->beginDropdown('ktv,ptb,trk,sadmin',   'Qu???n l?? c???p ph??t',    'bx bx-edit');
            $this->insertLink('ptb,ktv,sadmin',          'L???p d??? tr??',               '/device-plan');
            $this->insertLink('trk',      'Nh???n d??? tr??',              '/device-plan');
            //Nh???p thi???t b???: ktv ???????c ph??p thao t??c: xem, th??m, s???a, x??a | ptb & trk ch??? ???????c xem
            $this->insertLink('ktv,ptb,trk,sadmin',  'Nh???p thi???t b???',            '/document');
            $this->insertLink('ptb,trk,sadmin',      'B??n giao thi???t b???',        '/handover');
            $this->insertLink('ktv',          'Nh???n b??n giao',            '/handover');
        $this->endDropdown();
        //================
        //Qu???n l?? ki???m k??
        $this->beginDropdown('ktv,ptb,trk,sadmin',   'Ki???m k??',             'mdi mdi-clipboard-text-outline');
            $this->insertLink('ktv,ptb,trk,sadmin',  'Ki???m k?? t??? ?????ng',         '/auto-inventory');
            $this->insertLink('ktv,ptb,trk,sadmin',  'Ki???m k?? th??? c??ng',          '/inventory');
        $this->endDropdown();
        //================
        //Theo d??i
        $this->beginDropdown('ktv,ptb,trk,sadmin',   'Theo d??i',            'mdi mdi-eye');
            $this->insertLink('ktv,ptb,trk,sadmin',  'Nh???t k?? thi???t b???',          '/history');
            $this->insertLink('ktv,ptb,trk,sadmin',  'T???ng h???p thanh l??',         '/liquidate');
        $this->endDropdown();
        //================
        //T??m ki???m, b??o c??o
        $this->beginDropdown('ktv,sadmin,trk,ptb',   'T??m ki???m - B??o c??o',   'mdi mdi-book-search-outline');
//            $this->insertLink('ktv,ptb,trk',  'T??m ki???m',                  '/developing');
            $this->insertLink('ktv,sadmin',  'L???p b??o c??o',               '/report');
            $this->insertLink('ktv,sadmin,trk,ptb',  'T??m ki???m',               '/search');
        $this->endDropdown();
        //================

        //Qu???n tr??? h??? th???ng
        $this->insertTitle('admin,sadmin', 'CH???C N??NG D??NH RI??NG CHO AMDIN');
        $this->beginDropdown('admin,ktv,ptb,trk,sadmin',   'Qu???n l?? h??? th???ng', 'bx bx-chip');
            $this->insertLink('admin,sadmin',      'Qu???n l?? ng?????i d??ng',      '/users');
            $this->insertLink('admin,sadmin',      'Qu???n l?? vai tr??',         '/roles');
            $this->insertLink('admin,sadmin',      'Qu???n l?? menu ch??nh',      '/menu/menu');
            $this->insertLink('admin,sadmin',      'Qu???n l?? menu con',        '/menu/element');
            $this->insertLink('ktv,ptb,trk,sadmin',        'Qu???n l?? ph??ng',           '/room');
            $this->insertLink('ktv,admin,sadmin',  'Sao l??u, ph???c h???i',       '/developing');
            $this->beginDropdown('ktv,ptb,trk,sadmin',     'Qu???n l?? thi???t b???');
                $this->insertLink('ktv,sadmin',    'Danh m???c thi???t b???',       '/category-device');
                $this->insertLink('ktv,trk,ptb,sadmin',    'Danh s??ch thi???t b???',      '/device');
                $this->insertLink('ktv,trk,ptb,sadmin',    'Nh??m thi???t b???',      '/device-group');
            $this->endDropdown();
        $this->endDropdown();
        //================

        //????ng xu???t
        $this->insertLink('ktv,ptb,trk,admin,sadmin', '????ng xu???t', '/dangxuat', 'mdi mdi-logout');

        $this->joinAllByTransaction(); ///   <===== Must by use on end of this seeder
    }
}
