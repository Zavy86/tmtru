# tmtru

🔗 Tell Me The Real URL - A simple personal databaseless URL shortener and redirect

https://github.com/Zavy86/tmtru

## Setup

### Docker

The Dockerfile will set up an Apache2/PHP server running *tmtru*.

#### Options

- Volume dataset: as *tmtru* stores configuration and links as flat-files in json format, mapping this on the host allows
  easy access to settings and links. This can also be a named volume if you prefer.
- PUID/PGID (optional): in linuxserver.io fashion, this sets the UID/GID of the apache user within the container,
  so you can easily match a user on the host machine. Defaults to 1000/1000 if not set.

#### Quick run

`docker run -d -p 80:80 -v tmtru-dataset:/dataset -e PUID=1000 -e PGID=1000 zavy86/tmtru`

#### Docker Compose

```
version: '3'

services:
  tmtru:
    image: zavy86/tmtru
  environment:
    - PUID=1000
    - PGID=1000
  ports:
    - 80:80
  volumes:
    - tmtru-dataset:/dataset
```

#### Build and run a local image

From the source code directory execute commands:

`docker build --no-cache -t tmtru .`

`docker run -d -p 80:80 -v tmtru-dataset:/dataset -e PUID=1000 -e PGID=1000 tmtru`

### Manual

Get the source code cloning the repository with `git clone https://github.com/Zavy86/tmtru.git`
or download the latest release from https://github.com/Zavy86/tmtru/releases.

Create a new virtual host pointing to the `/public` directory.

## Configuration

- Open your browser to the defined url (example http://tmtru.test)
- Click on the tmtru logo (link image)
- Enter password `password` and press the Login button
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
