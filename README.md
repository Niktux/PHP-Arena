warrior
=======

Requirements
------------
* Virtualbox
* Vagrant
* vagrant-hostsupdater 
 `vagrant plugin install vagrant-hostsupdater`

Installation
------------
* Check if your user has edit right on hosts file (even in Windows)

* Fetch sources and configure development environment
```
git clone git@github.com:Niktux/warrior.git
php composer.phar install
cd env
vagrant up
```

* Open browser at `http:\\warrior.dev`
