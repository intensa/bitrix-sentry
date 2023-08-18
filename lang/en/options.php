<?php
$MESS['DSN'] = 'DSN (Data Source Name)';
$MESS['NOTE'] = "If no <b>DSN</b> specified, the module will take the SENTRY_DSN setting from .env<br>".
    "<b>Environment</b> is used to mark where the error occurred: production, dev server, etc.<br>".
    "If <b>environment</b> is not specified, the module will take the SENTRY_MODE setting from .env<br>".
    "If <b>environment</b> is not specified in .env, local is set by default.<br>".
    "If <b>environment</b> is set to local, logging in Sentry will not be performed.<br>".
    "You can also choose which <b>to ignore exceptions</b>. The types of such exceptions will not be logged in Sentry";
$MESS['ENVIRONMENT'] = 'Environment';
$MESS['SAVE'] = 'Save';
$MESS['EXCLUDED_ERRORS'] = 'Ignore exceptions';