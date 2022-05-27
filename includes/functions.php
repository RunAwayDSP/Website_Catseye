<?php

function checkUsername($username) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM accounts WHERE login=:login";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':login',$username);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }    
}

function authenticate($username) {
  global $dbconn;
    
  $strSQL = "SELECT * FROM accounts WHERE login = :username ";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':username',$username);
  if (!$statement->execute()) { 
    watchdog($statement->errorInfo(),'SQL'); 
  }
  else {
    $arrReturn = $statement->fetchAll(); 
  }
  if (!empty($arrReturn)) {
    $users['id'] = $arrReturn[0]['id'];
  }
  else {
    $users['id'] = 0;
  }
   
  $users['authed'] = TRUE;
  return $users;
}

function doLogin($username,$password) {
   global $dbconn;
   
  $strSQL = "SELECT * FROM accounts WHERE login = :username AND password = PASSWORD(:password)";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':username',$_POST['username']);
  $statement->bindValue(':password',$_POST['password']);
  if (!$statement->execute()) { 
    watchdog($statement->errorInfo(),'SQL'); 
  }
  else {
    $arrReturn = $statement->fetchAll(); 
  }
  if (!empty($arrReturn)) {
    return TRUE;
  }
  else {
    return FALSE;
  }
}

function getAccount($accid) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM accounts WHERE id=:accid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':accid',$accid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return NULL;
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return NULL;
    }
    else {
      return $arrReturn[0]['login'];
    }
  }
}

function getAccounts($accid) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM accounts WHERE id=:accid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':accid',$accid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return NULL;
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return NULL;
    }
    else {
      return $arrReturn[0];
    }
  }
}

function getCharacterID($accid) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM accounts_sessions WHERE accid=:accid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':accid',$accid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return NULL;
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return NULL;
    }
    else {
      return $arrReturn[0]['charid'];
    }
  }
}
function getItemList($itemid) {
  global $dbconn;

  $strSQL = "SELECT * from item_basic where name like :itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid', '%' . $itemid . '%');
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getItem($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from item_basic where itemid=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getItems($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from item_basic where itemid=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn[0];
    }
  }
}

function getItemName($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT sortname from item_basic where itemid=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    return 'Error retrieving item name';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'Error retrieving item name';
    }
    else {
      return ucwords(str_replace('_',' ',$arrReturn[0]['sortname']));
    }
  } 
}

function getArmor($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from item_equipment where itemId=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getWeapon($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from item_weapon where itemId=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getFurniture($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from item_furnishing where itemid=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getMods($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from item_mods where itemid=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getLatents($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from item_latents where itemid=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getItemDrops($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT mob_groups.name,mob_droplist.dropType,mob_droplist.itemRate,mob_groups.zoneid from mob_droplist LEFT JOIN mob_groups on mob_droplist.dropId=mob_groups.dropid LEFT JOIN mob_pools on mob_groups.poolid=mob_pools.poolid where mob_droplist.itemId=:itemid and mob_droplist.dropType>='0'";
  
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getCharacterName($charid) {
  global $dbconn;
  
  $strSQL = "SELECT charname FROM chars WHERE charid=:charid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':charid',$charid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return '';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn[0]['charname'];
    }
  }
}

function getCharacterByName($charname) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM chars WHERE charname=:charname";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':charname',$charname);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return '';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn[0];
    }
  }
}

function getCharacterAccid($charid) {
  global $dbconn;
  
  $strSQL = "SELECT accid FROM chars WHERE charid=:charid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':charid',$charid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return '';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn[0];
    }
  }
}

function getCharacterDBox($charid) {
  global $dbconn;
  
  $strSQL = "SELECT * from delivery_box where charid=:charid order by slot asc";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':charid',$charid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getCharacterList($accid) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM chars JOIN char_stats ON chars.charid=char_stats.charid JOIN char_jobs ON chars.charid=char_jobs.charid WHERE accid=:accid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':accid',$accid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getZoneName($zoneid) {
  global $dbconn;
  
  $strSQL = "SELECT name FROM zone_settings WHERE zoneid=:zoneid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':zoneid',$zoneid);
  
  if (!$statement->execute()) {
    return 'Error retrieving zone name';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return str_replace('_',' ',$arrReturn[0]['name']);
    }
  } 
}
?>