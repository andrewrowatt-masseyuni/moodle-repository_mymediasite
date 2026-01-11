@repository @repository_mediasite
Feature: Basic tests for Mediasite

  @javascript
  Scenario: Plugin repository_mediasite appears in the list of installed additional plugins
    Given I log in as "admin"
    When I navigate to "Plugins > Plugins overview" in site administration
    And I follow "Additional plugins"
    Then I should see "Mediasite"
    And I should see "repository_mediasite"
