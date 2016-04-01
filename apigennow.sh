rm -rf ./web/docs
apigen generate -s ./models,./controllers -d ./web/docs --template-theme "bootstrap"
