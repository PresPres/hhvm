/*
 * Copyright (c) Meta Platforms, Inc. and affiliates.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

package thrift

import (
	"errors"
	"fmt"
	"testing"
)

func compareStructs(m, m1 MyTestStruct) (bool, error) {
	switch {
	case m.On != m1.On:
		return false, errors.New("Boolean not equal")
	case m.B != m1.B:
		return false, errors.New("Byte not equal")
	case m.Int16 != m1.Int16:
		return false, errors.New("Int16 not equal")
	case m.Int32 != m1.Int32:
		return false, errors.New("Int32 not equal")
	case m.Int64 != m1.Int64:
		return false, errors.New("Int64 not equal")
	case m.D != m1.D:
		return false, errors.New("Double not equal")
	case m.F != m1.F:
		return false, errors.New("Float not equal")
	case m.St != m1.St:
		return false, errors.New("String not equal")

	case len(m.Bin) != len(m1.Bin):
		return false, errors.New("Binary size not equal")
	case len(m.Bin) == len(m1.Bin):
		for i := range m.Bin {
			if m.Bin[i] != m1.Bin[i] {
				return false, errors.New("Binary not equal")
			}
		}
	case len(m.StringMap) != len(m1.StringMap):
		return false, errors.New("StringMap size not equal")
	case len(m.StringList) != len(m1.StringList):
		return false, errors.New("StringList size not equal")
	case len(m.StringSet) != len(m1.StringSet):
		return false, errors.New("StringSet size not equal")

	case m.E != m1.E:
		return false, errors.New("MyTestEnum not equal")

	default:
		return true, nil

	}
	return true, nil
}

func ProtocolTest1(test *testing.T, serial *Serializer, deserial *Deserializer) (bool, error) {
	var m = MyTestStruct{}
	m.On = true
	m.B = byte(0)
	m.Int16 = 1
	m.Int32 = 2
	m.Int64 = 3
	m.D = 4.1
	m.St = "Test"
	m.Bin = make([]byte, 10)
	m.StringMap = make(map[string]string, 5)
	m.StringList = make([]string, 5)
	m.StringSet = make(map[string]bool, 5)
	m.E = 2

	s, err := serial.WriteString(&m)
	if err != nil {
		return false, fmt.Errorf("Unable to Serialize struct\n\t %s", err)
	}

	var m1 = MyTestStruct{}
	if err = deserial.ReadString(&m1, s); err != nil {
		return false, fmt.Errorf("Unable to Deserialize struct\n\t %s", err)

	}

	return compareStructs(m, m1)

}

func ProtocolTest2(test *testing.T, serial *Serializer, deserial *Deserializer) (bool, error) {
	var m = MyTestStruct{}
	m.On = false
	m.B = byte(0)
	m.Int16 = 1
	m.Int32 = 2
	m.Int64 = 3
	m.D = 4.1
	m.St = "Test"
	m.Bin = make([]byte, 10)
	m.StringMap = make(map[string]string, 5)
	m.StringList = make([]string, 5)
	m.StringSet = make(map[string]bool, 5)
	m.E = 2

	s, err := serial.WriteString(&m)
	if err != nil {
		return false, fmt.Errorf("Unable to Serialize struct\n\t %s", err)

	}

	var m1 = MyTestStruct{}
	if err = deserial.ReadString(&m1, s); err != nil {
		return false, fmt.Errorf("Unable to Deserialize struct\n\t %s", err)

	}

	return compareStructs(m, m1)

}

func TestSerializer(t *testing.T) {

	serializers := make(map[string]*Serializer)
	serializers["Binary"] = NewBinarySerializer()
	serializers["Compact"] = NewCompactSerializer()
	serializers["JSON"] = NewCompactJSONSerializer()
	deserializers := make(map[string]*Deserializer)
	deserializers["Binary"] = NewBinaryDeserializer()
	deserializers["Compact"] = NewCompactDeserializer()
	deserializers["JSON"] = NewCompactJSONDeserializer()

	tests := make(map[string]func(*testing.T, *Serializer, *Deserializer) (bool, error))
	tests["Test 1"] = ProtocolTest1
	tests["Test 2"] = ProtocolTest2
	//tests["Test 3"] = ProtocolTest3 // Example of how to add additional tests

	for name, serial := range serializers {

		for test, f := range tests {

			if s, err := f(t, serial, deserializers[name]); !s || err != nil {
				t.Errorf("%s Failed for %s protocol\n\t %s", test, name, err)
			}

		}
	}

}
