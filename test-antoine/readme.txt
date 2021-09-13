/* Upload segment informations / Terminal */

curl -v -X POST --data-binary "@segment.csv" \
   -H 'Authorization: Bearer ZjA2OTA4ZGU0Y2Q2MzQzYjYyYTE1NGNlYTZhYmYxMjY2OGI2NGI1YjgwOWQ1ODdhNmQ4OTk3YjQzYjA3NjcwMQ' \
   -H 'Content-Type: text/csv' \
   "https://api-data-connector-eu.abtasty.com/accounts/bba1c27bf34a03a5e089e1c7e133aedb/segments/dmp_example"

/* Fin ---- Upload segment informations / Terminal */