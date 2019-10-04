build:
	@./build.sh
all:
	@./build.sh all
clean:
	rm -rf rr
test_rpc:
	go build github.com/eplightning/roadrunner-logger/cmd/rr
	./rr serve -c tests/.rr.yaml -w ${PWD}/tests -l json
