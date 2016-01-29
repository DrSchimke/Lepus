Feature: Testing stuff

  Scenario:
    Given there is a queue "test"
    And the queue "test" is empty
    When I send a message to queue "test"
    """
     foo bar bla blubb
    """
    Then there should be a message in queue "test"
    """
     foo bar bla blubb
    """
