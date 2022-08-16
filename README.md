# tmtru

🔗 Tell Me The Real URL - A simple personal databaseless URL shortener and redirect

https://github.com/Zavy86/tmtru

## Setup

### Docker

Work in progress...

### Manual

Get the source code executing the command `composer create-project zavy86/tmtru`
or clone the repository with `git clone https://github.com/Zavy86/tmtru.git`
or download the latest release from https://github.com/Zavy86/tmtru/releases.

Enter the new directory and execute `composer install`.

Create a new virtual host pointing to the public directory.

Simple Apache/Laragon example:
```
<VirtualHost *:80> 
    DocumentRoot "C:/Laragon/www/tmtru/public"
    ServerName tmtru.test
    ServerAlias *.tmtru.test
    <Directory "C:/Laragon/www/tmtru/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## Configuration

- Open your browser to the defined url (example http://tmtru.test)
- Click on the tmtru logo (link image)
- Enter password `password` and press theLogin button
- Click the Settings menu on the navigation bar
- Choose the length of the generated UIDs (default 3)
- Change the title if you want
- Insert your Name or your Company
- Optionally add your Google Analytics Tag
- Choose a new password
- Press the Save settings button

### Usage

#### View Links

In the administration page you can view all existing links.

- Click on the link icon to open the selected link.
- Click on the UID to view or edit a link.

#### New Link

In the administration page you can create a new link.

- Click on the New link button in the navigation bar.
- Fill the uid manually or leave it blank to have it generated automatically.
- Enter the URL you want to point to.
- Enter a description and some tags.
- Press the Save link button.o

## Screenshots

### Settings

![settings screeshot](https://raw.githubusercontent.com/Zavy86/tmtru/master/screenshots/tmtru_settings.png "Settings")

### Links List

![list screeshot](https://raw.githubusercontent.com/Zavy86/tmtru/master/screenshots/tmtru_list.png "Settings")

### Add Link

![add screeshot](https://raw.githubusercontent.com/Zavy86/tmtru/master/screenshots/tmtru_add.png "Settings")

### Edit Link

![edit_screeshot](https://raw.githubusercontent.com/Zavy86/tmtru/master/screenshots/tmtru_edit.png "Settings")
