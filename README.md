# Bitter Template Engine
PHP template Engine

Config Methods
----------
`Config::setExtension([string] $extension)` :  changes default template file extension.     
`Config::setTemplatePath([string] $path)` :  changes default template files path.         
`Config::setLogDir([string] $path)` :  changes default log directory.         
`Config::setTimeZone([string] $timezone_identifier)` :  changes default timezone identifier.          
`Config::setTags([string] $opening_tag, ([string] $closing_tag))` :  changes default template tags.  
`Config::listAttribute()` : list all defined attributes.  
`Config::listOut([bool] $with_extension)` : lists all the template files.   

References
----------
`inc` : includes and evaluates the specified file             
`req` : alias of `inc` but throws an error upon failure



