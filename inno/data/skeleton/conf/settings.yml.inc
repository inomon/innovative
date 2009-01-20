# do not edit manually
inno_autoload:
  classes: [assets.innoAssets, renderer.innoRenderer, request.innoRequest, routing.innoRouting, controller.innoController, exception.innoError401Exception, exception.innoError403Exception, exception.innoError404Exception, exception.innoSkipActionException]
  helpers: [Tag, Fragment, Assets]
database:
  orm:           propel
  host:          localhost
  username:      root
  password:      root
  type:          mysql       
  db_name:       database
  enable_conn:   false
propel:
  project: innovative
  database: 
    type: ###TYPE###
    url: '###TYPE###:host=###HOST###;dbname=###DB_NAME###'
    user: ###USERNAME###
    password: ###PASSWORD###
  php:
    dir: '${propel.project.dir}/../../../lib/classes'
  phpconf:
    dir: '${propel.project.dir}/'
  sql:
    dir: '${propel.project.dir}/../sql'
  twin: []
  reference_values:
    database:
      type: [pgsql, mysql, sqlite, mssql, oracle]
doctrine:
  project: innovative
  url:     '###TYPE###://###USERNAME###:###PASSWORD###@###HOST###/###DB_NAME###'
# start editing here

