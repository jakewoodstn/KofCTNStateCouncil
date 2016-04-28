<?php
 
 
class kcUserFactory{ 
	 
	protected $modx;
	 
	function __construct($modx) {
		$this->modx=$modx;
	}
	 
	function makeUser($row){
		
		$pUser = $this->modx->getObject('modUser',array('username'=>$row['username']));
		
		if	($pUser){ }
		else {
		    $data = array();
		    $data['active'] = true;
		    $data['username'] = $row['username'];
		    $data['fullname'] = $row['name'];
		    $data['email'] = $row['email'];
				
		    $object = $this->modx->newObject('modUser');
		    $object->fromArray($data);
		    	
		    $profile = $this->modx->newObject('modUserProfile');
		    $profile->set('fullname',$data['fullname']);
		    $profile->set('email',$data['email']);
		    		    
		    $object->addOne($profile, 'Profile');	
		    		    		   
		    $object->set('password',$row['password']);  
		    		                    
		    $object->save();
		  
		    $usergroup = $this->modx->getObject('modUserGroup', array('name' =>  $row['group']));
	
		    if ($usergroup) {$object->joinGroup($usergroup->get('id'),1);}
		    
		}
				    
		$err = $this->modx->error->success();

		if ($err['total']>0){ print_r('User Creation Errors: '. $err['errors']);}
		    else{
				$kpUser = $this->modx->getObject('kofcuser',array('name' => $row['username']));
				
				if ($kpUser) { print_r('kc user found');}
				else{
			    	$kcdata=array();
			    	$kcdata['name']=$row['username'];
			    	$kcdata['firstName']=$row['firstName'];
			    	$kcdata['preferredFirstName'] = $row['preferredName'];
		
					$kcdata['lastName']=$row['lastName'];
			    	$kcdata['primaryEmail']=$row['email'];
		
					$council = $this->modx->getObject('council',array('councilNumber'=>$row['councilNumber']));
		
			    	$kcdata['councilId'] = $council->get('id');
			    	
			    	$kcuser = $this->modx->newObject('kofcuser');
			    	$kcuser->fromArray($kcdata);
			    	$kcuser->save();
		    	}
		    }
		    
		$err = $this->modx->error->success();
		
		if ($err['total']>0){ print_r('KC User Creation Errors: ' . $err['errors']);}
		    
		//print_r($err['errors']);
		return 'success';
	}
}