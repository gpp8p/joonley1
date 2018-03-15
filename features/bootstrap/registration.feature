Feature: Register New User
  Background:
    Given I am not registered user

  Scenario: Go to register new user - mobile and standard
    Given I am on login page
    And I am a new user
    And I click on the "I am an individual user - sign me up" link
    Then I will be directed to the individual user registration page

  Scenario: New user, part of a company already on the system
    Given I am on the login page
    And I am a new user
    And I work for a company that already is a user of the system
    And I click on the "I am a new user but my company is on the system" link
    Then I will be directed to the select my company page.

  Scenario: Select company - company not on system yet
    Given: I have already clicked on the "I am a new user but my company is on the system" link
    And I am on the "identify company" page
    And I am associated with a company
    And I can't find my company
    When I click on the "register my company with the system"
    Then I will be directed to "new company profile" page

  Scenario: I have filled out the new company profile page
    Given: My company is not registered with the system
    And: I have filled out the company profile page
    When I click on the "I am a new user" link
    Then I will be directed to the "new user profile" page
    And I will be associated with the company profile just entered

   Scenario: I have filled out the new company profile page
     Given: My company is not registered with the system
     And: I have filled out the company profile page
     When I click on "I am already a user" link
     Then I will be asked to enter my user ID and authenticate.
     And I will be associated with the company just entered.

  Scenario: Enter new user profile - company identified
    Given: I have clicked on the "sign me up" button on the login page
    And I have selected a company I am associated with
    And I am on the new profile page
    And I have filled out all the information correctly
    And I have clicked on the 'sign me up now' button
    Then I will be given limited access to the system
    And my registrartion request will be conveyed to Company admin for approval via a <message>
    And I will be sent a verification email

  Scenario: Enter new user profile - company not identified
    Given: I have clicked on the "sign me up" button on the login page
    And I have not identified company I am associated with
    And I am associated with a company
    And I am on the new profile page
    And I have filled out all the information correctly
    And I have clicked on the 'sign me up now' button
    Then my registrartion request will be conveyed to system admin for approval via a <message>
    And I will be sent a verification email







