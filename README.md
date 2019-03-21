# joindin-platformsh
The deploy Repo for platform.sh

#### To Deploy:
Switch to the branch you're ready to deploy (master|staging).

`./bin/deploy`

If the platform.sh cli is installed and properly configured it will perform a snapshot before firing off a deploy.

Any uncommitted changed will be stashed. 