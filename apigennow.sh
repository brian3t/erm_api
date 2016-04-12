rm -rf ./web/docs
apigen generate -s ./models,./controllers,./rop,./mp -d ./web/docs --template-theme "bootstrap"
