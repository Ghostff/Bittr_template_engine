# Bitter Template Engine
PHP template Engine

Config Methods
----------
`Config::setExtension([string] $extension)` :  changes default template file extension.     
`Config::setTemplatePath([string] $path)` :  changes default template files path.         
`Config::setLogDir([string] $path)` :  changes default log directory.         
`Config::setTimeZone([string] $timezone_identifier)` :  changes default timezone identifier.          
`Config::setTags([string] $opening_tag, ([string] $closing_tag))` :  changes default template tags.        

References
----------
`inc` : includes and evaluates the specified file             
`req` :  alias of `inc` but throw an error upon failure            



