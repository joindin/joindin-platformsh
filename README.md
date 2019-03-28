# joindin-platformsh
The deploy Repo for platform.sh

#### To Deploy:
Switch to the branch you're ready to deploy (master|staging).

`./bin/deploy [<snapshot>]`
#### Snapshot (optional)
If the platform.sh cli is installed and properly configured it will perform a snapshot before firing off a deploy.

By default, this only happens if you're in the master branch. Passing true in any other branch will fire off a snapshot.
Passing false in master branch will prevent a snapshot.

Any uncommitted changes will be stashed before updating and commiting submodules then will be popped. 
