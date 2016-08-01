# WP Launchable
A framework for ensuring your WordPress environment is ready to deploy into production and hand over to a client.

![screenshot](/screenshot_@2x.png.png)

Currently checks whether:
- You have enabled/disabled DEBUG mode as appropriate (dependant on whether this is a Test/Production environment)
- You have set strong passwords
- You have disabled the WP code editor
- You have updated the tagline
- You have unblocked robots.txt
- You have customised the admin footer
- Framework allows for additional checks to be made, and for quickfixes to be recommended.

Useful for:
- Setting up new development environments
- Pre-launch checks, in preparation for handing over to a client.

## Distinguishing between Production and Test environments
Whilst distinguishing between Test and Production isn't typically good practise - this plugin does so, and with good reason.
For example: The plugin will alert you if DEBUG is enabled in production, or if DEBUG is disabled in test.
By default, the **is_production()** function shall return **false** for siteurls matching: localhost, *.dev.
Alternatively, you can define a custom rule.

## Configuration
At present - no configuration required.

## Contributing
- Contributions are welcomed
- Feature requests: Please log as issues in Github
- Bugs: Please log as issues in Github
- Pull requests: Yes please.

## Test Suite
- The test suite is not implemented yet

## License

The MIT License (MIT)

Copyright (c) 2014 Jack Barker

