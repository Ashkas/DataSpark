# Location of the theme's resources.
css_dir = "assets/css"
sass_dir = "assets/sass"
images_dir = "assets/img"
generated_images_dir = "assets/img/dist"
javascripts_dir = "assets/js"
fonts_dir = "assets/fonts"

# Require any additional compass plugins installed on your system.
require 'compass-normalize'
require 'toolkit'
require 'breakpoint'
require 'susy'

##
## You probably don't need to edit anything below this.
##

# You can select your preferred output style here (:expanded, :nested, :compact
# or :compressed).2

output_style = (environment == :production) ? :compressed : :expanded

# To enable relative paths to assets via compass helper functions. Since Drupal
# themes can be installed in multiple locations, we don't need to worry about
# the absolute path to the theme from the server omega.
relative_assets = true

# Conditionally enable line comments when in development mode.
line_comments = (environment == :production) ? false : true

# Add the 'sass' directory itself as an import path to ease imports.
add_import_path 'assets/sass'