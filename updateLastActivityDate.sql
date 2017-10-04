UPDATE user, (SELECT u.id FROM user u
  LEFT JOIN user_recipient on u.id = user_recipient.account_owner_id
WHERE user_recipient.id IS NULL) as p SET user.lastActivityDate = user.updated_at
WHERE p.id = user.id;

UPDATE user
JOIN user_recipient on user.id = user_recipient.account_owner_id
    SET user.lastActivityDate = user_recipient.updated_at
WHERE user_recipient.id in (
  SELECT m.id
  FROM user_recipient m
    LEFT JOIN user_recipient b
      ON m.account_owner_id = b.account_owner_id
         AND m.updated_at < b.updated_at
  WHERE b.updated_at IS NULL
)
