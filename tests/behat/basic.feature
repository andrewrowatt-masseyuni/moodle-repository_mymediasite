@repository @repository_mymediasite
Feature: Basic tests for Mymediasite

  @javascript
  Scenario: Plugin repository_mymediasite appears in the list of installed additional plugins
    Given I log in as "admin"
    When I navigate to "Plugins > Plugins overview" in site administration
    And I follow "Additional plugins"
    Then I should see "Mymediasite"
    And I should see "repository_mymediasite"
