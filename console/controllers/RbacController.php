<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\rbac\UserRoleRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        //CREATE PERMISSIONS        
        //Permission to create users
        $createUsers = $auth->createPermission('createUsers');
        $createUsers->description = 'Create Users';
        $auth->add($createUsers);
     
        //Permission to edit user profile
        $editUserProfile = $auth->createPermission('editUserProfile');
        $editUserProfile->description = 'Edit User Profile';
        $auth->add($editUserProfile);
     
        //APPLY THE RULE
        $rule = new UserRoleRule(); //Apply our Rule that use the user roles from user table
        $auth->add($rule);
     
        //ROLES AND PERMISSIONS
        //user role
        $user = $auth->createRole('user');  //user role
        $user->ruleName = $rule->name;
        $auth->add($user);
        // ... add permissions as children of $user ...
            //none in this example
     
        //editor role
        $editor = $auth->createRole('editor');
        $editor->ruleName = $rule->name;
        $auth->add($editor);
        // ... add permissions as children of $editor ..
            $auth->addChild($editor, $user); //user is a child of editor
        $auth->addChild($editor, $editUserProfile); //editor can edit profiles
     
        //Admin role
        $admin = $auth->createRole('admin');
        $admin->ruleName = $rule->name;
        $auth->add($admin);
        $auth->addChild($admin, $editor); //editor is child of admin, for consequence user is also child of admin
        // ... add permissions as children of $admin ..
        $auth->addChild($admin, $createUsers); //admin role can create users and also edit users because is parent of editor
    }
}