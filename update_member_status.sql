SELECT nameFirst, nameLast, emailAddress, `membershipExpire`
FROM `jos_cbodb_members`
WHERE `membershipExpire`<=CURRENT_TIMESTAMP AND `isMember` = 1;

UPDATE `jos_cbodb_members`
SET `isMember` = 0
WHERE `membershipExpire`<=CURRENT_TIMESTAMP AND `isMember` = 1;