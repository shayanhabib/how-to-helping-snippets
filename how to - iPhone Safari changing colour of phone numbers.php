iPhone Safari changing colour of phone numbers

1. Stop Safari from detecting and enabling phone number links with the following meta tag
<meta name="format-detection" content="telephone=no">


2. Add the following to the CSS which will force Safari to keep the original styling
a[href^=tel] {
   text-decoration:inherit;
   color: inherit;
}