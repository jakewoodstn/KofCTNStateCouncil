<?php
exit;

define('MODX_API_MODE', true); // Gotta set this one constant.
 
// Reset the password and email of an existing user
// and ensure they are a member of the specified group
$username = 'modxadmin';
$password = 'Y5ehv4Sqax4DEDQf';
$email = 'jake.woods@comcast.net';
 
$user_group = 1; // 1 for Administrator 
 
// Full path to the MODX index.php file
require_once('index.php');
 
// ====== Don't change anything below this line ======
if (empty($username) || empty($password) || empty($email)) {
        die('ERROR: Missing criteria.');
}
 
 
 
$modx= new modX();
$modx->initialize('mgr');
 
$query = $modx->newQuery('modUser');
$query->where( array('username'=>$username) );
$user = $modx->getObjectGraph('modUser', '{ "Profile":{}, "UserGroupMembers":{} }', $query);
// print_r($user); exit;
if (!$user) {
        die("ERROR: No user with username $username");
}
 

$user->set('username',$username);
$user->set('active',1);
$user->set('password', $password);
$user->Profile->set('email', $email);
$user->Profile->set('blocked', 0);
$user->Profile->set('blockeduntil', 0);
$user->Profile->set('blockedafter', 0);
 
// Verify the user is a member of specified User Group
$is_member = false;
if (!empty($user->UserGroupMembers)) {
        foreach ($user->UserGroupMembers as $UserGroupMembers) {
                if ($UserGroupMembers->get('user_group') == $user_group) {
                        $is_member = true;
                        break;                  
                }
        }
}
// Add the User to the User Group if he is not a member
if (!$is_member) {
        // Verify the user group exists
        $UserGroup = $modx->getObject('modUserGroup', $user_group);
        if (!$UserGroup) {
                die ("ERROR: User Group $user_group does not exist.");
        }
 
        $Member = $modx->newObject('modUserGroupMember');
        $Member->set('user_group', $user_group); 
        $Member->set('member', $user->get('id'));
        // Super User = role 2
        $Member->set('role', 2); 
        $Member->set('rank', 0);
        $user->addOne($Member,'UserGroupMembers');
}
 
/* save user */
if (!$user->save()) {
        die('ERROR: Could not save user.');
}
 
print "SUCCESS: User $username updated.";
 
?>