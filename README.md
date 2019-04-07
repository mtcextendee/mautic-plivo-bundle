# Mautic Plivo Plugin

Plivo SMS Transport Integration for >= Mautic 2.13 
Integration is just another SMS transport along with core Twillio, Slooce SMS Transport https://github.com/mautic-inc/plugin-slooce or MessageBird SMS Integration https://github.com/mautic/plugin-messagebird

For more info about Plivo follow https://www.plivo.com/

## Installation by console

1. `composer require mtcextendee/mautic-plivo-bundle`
2. `php app/console mautic:plugins:reload`

Manual installation is not allowed, because dependency on plivo-sdk library.

## Usage

1. Go to Mautic > Settings > Plugins
2. You should see new Plivo integration
3. Active integration and setup it

<img src="https://user-images.githubusercontent.com/462477/55688009-0961e600-5974-11e9-9e4f-2f06cdddaa4a.png" width="500" alt="">

4. Authentication credentials can be found at http://manage.plivo.com/dashboard
5. Then go to Configuration > Text message settings and select Plivo SMS as  default transport to use

<img src="https://user-images.githubusercontent.com/462477/55688093-16cba000-5975-11e9-852d-0a0d3e716ae9.png" width="500" alt="">

6. For more info about text message Mautic support, follow docs https://www.mautic.org/docs/en/sms/index.html

## More Mautic stuff

- Plugins from Mautic Extendee Family  https://mtcextendee.com/plugins
- Mautic themes https://mtcextendee.com/themes
