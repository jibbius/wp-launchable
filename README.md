# WP Launchable
**WARNING: This code is incomplete. It doesn't do anything useful at this stage!**

A framework for performing **LaunchChecks** and **Quickfixes** upon your WordPress environment.

Useful for:
- Setting up new development environments
- Pre-launch checks, in preparation for handing over to a client.

## LaunchChecks
LaunchChecks are tasks that get run when viewing the WordPress dashboard.
If a check fails then it will raise a message within the WordPress Dashboard for the administrator to attend to.
The message may (optionally) present one or more Quickfixes - as a means to remedy the failed check.

## Quickfixes
A Quickfix is a button / action, that is presented to the administrator as a means to solve the failed check.

## Distinguishing between Production and Test environments
The intention, is that a different set of config will be stored for Prod vs. Test/Dev.
The plugin shall determine which config to load.
An **is_production()** function shall return false for siteurls matching: localhost, *.dev, or a custom rule.

## Configuration
Still determining whether config will be stored in the database, or saved to file.
Leaning toward the latter.

## Contributing
- Contributions are welcomed
- Feature requests: Please log as issues in Github
- Bugs: Please log as issues in Github
- Pull requests: Yes please.

## Test Suite
- The test suite is not correctly implemented yet

## License

The MIT License (MIT)

Copyright (c) 2014 Jack Barker

