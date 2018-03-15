Feature: Login to application
  Background:
    Given I am registered user
    And my account is activated

  Scenario Outline: Successful login
    Given I am on login page
    When I fill "login" with <login>
    And I fill "password" with <correct-password>
    And I click "Login" button
    Then I am redirected to page with profile select

    Examples:
      | login  | correct-password |
      | Lolly  | Ldes1se          |
      | Jedd   | Cucumb3r         |

  Scenario Outline: Unsuccessful login
    Given I am on login page
    When I fill "login" with <login>
    And I fill "password" with <incorrect-password>
    And click "Login" button
    Then I am be informed about unsuccessful login

    Examples:
      | login    | incorrect-password |
      | Lolly    | Gherkin            |
      | Jedd     | Cucumber           |

  Scenario: Unauthorized entry
    Given I am not logged in
    When I try to go Dashboard page
    Then I am redirected to login page

  Scenario: Mobile phone app - successful auto-login
    Given I am using the mobile app
    And I have started the app
    And I have previously entered login credenmtials
    And The credentials have been previously validated by the system
    And I have checked the 'auto-login' option in my profile
    And My previous login does not preceed the system-wide time limit
    Then I will be conveyed to the main dashboard screen

  Scenario: Mobile phone app - unsuccessful auto-login due to stale login
    Given I am using the mobile app
    And I have started the app
    And I have previously entered login credenmtials
    And The credentials have been previously validated by the system
    And I have checked the 'auto-login' option in my profile
    And My previous login does preceed the system-wide time limit
    Then I will be directed to login screen

  Scenario: Mobile phone app - no prior credentials
    Given I am using the mobile app
    And I have started the app
    And I have not previously entered login credenmtials
    Then I will be directed to the login screen

  Scenario: Mobile phone app - no previously entered credentials, successful login
    Given I am using the mobile app
    And I have started the app
    And I am at the login screen
    When I click on  checkbox to save my login credentials
    And I fill "login" with <login>
    And I fill "password" with <correct-password>
    And I click on login button
    Then I will be directed to main dashboard screen
    And my login id and password will be encrypted and saved locally by the app

  Scenario: Mobile phone app - no previously entered credentials, un-successful login
    Given I am using the mobile app
    And I have started the app
    And I am at the login screen
    When I click on  checkbox to save my login credentials
    And I fill "login" with <login>
    And I fill "password" with <incorrect-password>
    And I click on login button
    Then An error message will be displayed and I will be directed back to login screen






