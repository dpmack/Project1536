Feature: Login
	As a user
	I am able to log in and out
	
	Scenario: User can log in
		Given that I am on the "Login" page
		When I fill in my user info
		And I click on the "Login" button
		Then I should be logged in
	
	Scenario: Password is encrypted before being submitted
		Given that I am on the "Login" page
		When I fill in my user info
		And I click the "Login" button
		Then my password should be encrypted before being sent

	Scenario: Browsers with javascript disabled warn with a span that password isn't encrypted while javascript is disabled
		Given that I am on the "Login" page
		And that javascript is disabled
		Then I should see the warning about password encryption
	
	Scenario: Login session is tracked by IP / login ticket
		Given that I am logged in
		Then I should have a cookie with my login ticket

	Scenario: Login ticket is generated server side and stored in the db
		Given that a user is logged in
		Then there should be a ticket in the users db record
	
	Scenario: Cannot login with invalid info
		Given that I am on the "Login" page
		When I fill in my user name correctly
		And I fill in my password wrong
		And I click the "Login" button
		Then I should see the error "Invalid username/password combination"
		
		When I fill in my user name wrong
		And I fill in my password correctly
		And I click the "Login" button
		Then I should see the error "Invalid username/password combination"
	
	Scenario: Can logout
		Given that I am logged in
		When I click the "Logout" button
		Then I should be on the "Home" page
		And I should be logged out
		And I should not have a login cookie
		
		When I try to access "My Account" page
		Then I should see the "Login" page
	
	Scenario: Logout timeout after 30 mins of inactivity
		Given that I am logged in
		When I am inactive for 30 mins
		And I try to access "My Account" page
		Then I should see the "Login" page
		And I should be logged out
		And I should not have a login cookie