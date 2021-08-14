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
        $this->insertLink('ktv,ptb,trk,admin', 'Dashboard', '/', 'cil-speedometer');

        $this->beginDropdown('admin', 'Settings', 'cil-calculator');
            $this->insertLink('admin', 'Users',                   '/users');
            $this->insertLink('admin', 'Edit menu',               '/menu/menu');
            $this->insertLink('admin', 'Edit menu elements',      '/menu/element');
            $this->insertLink('admin', 'Edit roles',              '/roles');
        $this->endDropdown();

        $this->beginDropdown('ktv', 'Test', 'cil-bell');
            $this->insertLink('ktv', 'ktv', '/duc');
        $this->endDropdown();

        $this->beginDropdown('ptb', 'Test ptb', 'cil-bell');
            $this->insertLink('ptb', 'ptb', '/duc');
        $this->endDropdown();

        $this->beginDropdown('trk', 'Test trk', 'cil-bell');
            $this->insertLink('trk', 'trk', '/duc');
        $this->endDropdown();

        $this->insertLink('ktv,ptb,trk,admin', 'Đăng xuất', '/dangxuat', 'cil-account-logout');

        $this->joinAllByTransaction(); ///   <===== Must by use on end of this seeder
    }
}
