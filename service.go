package logger

import (
	"github.com/sirupsen/logrus"
	"github.com/spiral/roadrunner/service/rpc"
)

const ID = "logger"

type Service struct {
}

func (s *Service) Init(r *rpc.Service, l *logrus.Logger) (bool, error) {
	r.Register("logger", &rpcService{
		logger: l,
	})

	return true, nil
}
