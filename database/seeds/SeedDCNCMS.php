<?php

use DCN\Page;
use DCN\Permission;
use DCN\Role;
use DCN\User;
use DCN\Settings;
use Illuminate\Database\Seeder;

class SeedDCNCMS extends Seeder
{

    public function run()
    {
        /*
         * Roles and Permissions
         */
        $rolesAndPermissions = array(
            array(
                'name' => 'Root',
                'slug'=>'root',
                'description'=>'Root/God Users',
                //'level'=>1000000000,
                'parent_id'=>NULL,
                'permissionsArray'=>array()
            ),
            array(
                'name' => 'Admin',
                'slug'=>'admin',
                'description'=>'Admin Users',
                //'level'=>999999999,
                'parent_id'=>1,
                'permissionsArray'=>array()
            ),
            array(
                'name' => 'Settings Admin',
                'slug'=>'admin.settings',
                'description'=>'Settings Management Admins',
                //'level'=>5000,
                'parent_id'=>2,
                'permissionsArray'=>array(
                    array('slug'=>'settings.auth',      'name' => 'Auth Settings',                  'description'=>'Manage User, Role, and Auth Settings'),
                    array('slug'=>'settings.page',      'name' => 'Page Settings',                  'description'=>'Manage Page Settings'),
                    array('slug'=>'settings.project',   'name' => 'Project Settings',               'description'=>'Manage Project Settings'),

                )
            ),
            array(
                'name' => 'User Admin',
                'slug'=>'admin.user',
                'description'=>'User Management Admins',
                //'level'=>5000,
                'parent_id'=>2,
                'permissionsArray'=>array(
                    array('slug'=>'user.create',        'name' => 'Create Users',                   'description'=>'People with this permission can create new users'),
                    array('slug'=>'user.edit',          'name' => 'Edit Users',                     'description'=>'People with this permission can Edit existing users'),
                    array('slug'=>'user.lock',          'name' => 'Lock Users',                     'description'=>'People with this permission can temporarily lock users out of the website'),
                    array('slug'=>'user.unlock',        'name' => 'Unlock Users',                   'description'=>'People with this permission can unlock users to allow them access to the website'),
                    array('slug'=>'user.ban',           'name' => 'Ban Users',                      'description'=>'People with this permission can permanently ban users from the website'),
                    array('slug'=>'user.unban',         'name' => 'Unban Users',                    'description'=>'People with this permission can unban users to allow them access to the website'),
                    array('slug'=>'user.delete',        'name' => 'Delete Users',                   'description'=>'People with this permission can delete users'),
                    array('slug'=>'user.reset',         'name' => 'Reset Users Password',           'description'=>'People with this permission can reset users passwords'),
                    array('slug'=>'user.roles',         'name' => 'Manage User Roles',              'description'=>'People with this permission can assign and edit roles assigned to users'),
                    array('slug'=>'user.permissions',   'name' => 'Manage User Permissions',        'description'=>'People with this permission can assign and edit the permissions assigned to users'),
                    array('slug'=>'user.manage',        'name' => 'Manage Users',                   'description'=>'People with this permission can manage users'),

                )
            ),
            array(
                'name' => 'Page Admin',
                'slug'=>'admin.page',
                'description'=>'Page Management Admins',
                //'level'=>5000,
                'parent_id'=>2,
                'permissionsArray'=>array(
                    array('slug'=>'page.create',        'name' => 'Create Website Pages',           'description'=>'People with this permission can create new website pages'),
                    array('slug'=>'page.edit',          'name' => 'Edit Website Pages',             'description'=>'People with this permission can edit website pages'),
                    array('slug'=>'page.publish',       'name' => 'Publish Website Pages',          'description'=>'People with this permission can publish website pages'),
                    array('slug'=>'page.unpublish',     'name' => 'Unpublish Website Pages',        'description'=>'People with this permission can unpublish website pages'),
                    array('slug'=>'page.review',        'name' => 'Review Website Pages',           'description'=>'People with this permission can review and edit website pages before they are published'),
                    array('slug'=>'page.delete',        'name' => 'Delete Website Pages',           'description'=>'People with this permission can delete website pages'),
                    array('slug'=>'page.owner',         'name' => 'Own Website Pages',              'description'=>'People with this permission can be own website changes and be notified of any and all changes'),
                    array('slug'=>'page.system',        'name' => 'Manage System Website Pages',    'description'=>'People with this permission can create and edit system pages'),
                )
            ),
            array(
                'name' => 'Member',
                'slug'=>'member',
                'description'=>'Default Group For All Users',
                //'level'=>1,
                'parent_id'=>1,
                'permissionsArray'=>array(
                    array('slug'=>'portal',             'name' => 'Portal Access',                  'description'=>'People with this permission can access the web portal'),
                )
            ),
        );

        foreach($rolesAndPermissions as $roleArray)
        {
            $permissionsArray = $roleArray['permissionsArray'];
            unset($roleArray['permissionsArray']);
            $role = Role::create($roleArray);

            foreach($permissionsArray as $permission)
            {
                $permission = Permission::create($permission);
                $role->attachPermission($permission);
            }
        }

        /*
         * Users
         */
        $users = array(
            array(
                'name_first'=>'Root',
                'name_last'=>'Admin',
                'email'=>'root@localhost',
                'username'=>'root',
                'password'=>'R00T',
                'status'=>'active',
                'roleSlugs'=>array(
                    'root',
                ),
                'permissionSlugs'=>array(
                )
            ),
            array(
                'name_first'=>'Website',
                'name_middle'=>'Admin',
                'name_last'=>'istrator',
                'email'=>'admin@localhost',
                'username'=>'admin',
                'password'=>'@dm1n',
                'status'=>'active',
                'roleSlugs'=>array(
                    'admin',
                ),
                'permissionSlugs'=>array(
                )
            ),
        );
        foreach($users as $userArray)
        {
            $roleSlugs = $userArray['roleSlugs'];
            unset($userArray['roleSlugs']);
            $permissionSlugs = $userArray['permissionSlugs'];
            unset($userArray['permissionSlugs']);

            $user = User::create($userArray);
            foreach($roleSlugs as $roleSlug)
            {
                $role = Role::bySlug($roleSlug);
                $user->attachRole($role);
            }
            foreach($permissionSlugs as $permissionSlug){
                $permission = Permission::find($permissionSlug);
                $user->attachPermission($permission);
            }
        }

        /*
         * Pages
         */
        $pages = array(
            array(
                'title'=>'Home Page',
                'slug'=>'home',
                'description'=>'Website Home Page',
                'content'=> '<div class="row clearfix"><div class="col-md-12"><figure class="hdr one"><img src=/assets/vendor/ContentBuilder/assets/minimalist-basic/o04-1.jpg><div><figcaption><h2>DCN CMS</h2><p>Take a breath. We do the hard work.</p></figcaption></div></figure></div></div><div class="row clearfix"><div class="col-md-12"><div class="display text-center"><h1>View The Source.</h1><p>And use it on your own. Or let us install and manage it for you.</p></div></div></div><div class="row clearfix"><div class="col-md-12 text-center"><div style="margin:1em 0 2.5em"><a href=https://github.com/DynamicCodeNinja/CMS class="btn btn-primary" target=_blank>View on Github</a></div></div></div><div class="row clearfix"><div class="col-md-4 pull-right"><p><b>DynamicCode.Ninja</b><br>A CloudMy.IT LLC Orginization focused on web development and making your life easier.</p><div class="social edit"><a href="https://twitter.com/"><i class="icon-twitter"></i></a><a href="https://www.facebook.com/"><i class="icon-facebook"></i></a><a href="https://plus.google.com/"><i class="icon-googleplus"></i></a><a href="mailto:you@example.com"><i class="icon-mail"></i></a></div></div><div class="col-md-8 text-center"><img src="/assets/vendor/ContentBuilder/assets/minimalist-basic/s01-1.jpg" class="img-circle" style="margin-top:1.2em"></div></div>',
                'owner_id'=>1,
                'creator_id'=>1,
                'updater_id'=>1,
                'system'=>true,
                'status'=>'published'
            ),
        );

        foreach($pages as $page)
        {
            Page::create($page);
        }
        /*
         * Settings
         */
        $settings = array(
            array(
                'key'=>'publicSignup',
                'value'=>false
            )
        );

        foreach($settings as $setting)
        {
            Settings::create($setting);
        }



    }

}