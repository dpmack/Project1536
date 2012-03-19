INSERT INTO accounts
(firstName, lastName, username, email, password, emailConfirmed)
VALUES ("Demo", "User", "A00000000", "csthub+demoaccount@gmail.com", "", 1);

UPDATE accounts
SET accountID = 0
WHERE username = "A00000000";