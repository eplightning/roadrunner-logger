package logger

import (
	"time"

	"github.com/sirupsen/logrus"
)

type rpcService struct {
	logger *logrus.Logger
}

type LogLine struct {
	Level     string
	Message   string
	Timestamp time.Time
	Fields    map[string]interface{}
}

func (s *rpcService) Line(line LogLine, result *bool) error {
	level, err := logrus.ParseLevel(line.Level)
	if err != nil {
		*result = false
		return err
	}

	entry := s.logger.WithTime(line.Timestamp)

	if len(line.Fields) > 0 {
		entry = entry.WithFields(line.Fields)
	}

	entry.Log(level, line.Message)

	*result = true
	return nil
}
