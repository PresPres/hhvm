/**
 * Autogenerated by Thrift
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 *  @generated
 */
package test.fixtures.adapter;

import java.util.List;
import java.util.ArrayList;
import java.util.Map;
import java.util.HashMap;
import java.util.Set;
import java.util.HashSet;
import java.util.Collections;
import java.util.BitSet;
import java.util.Arrays;
import com.facebook.thrift.*;
import com.facebook.thrift.annotations.*;
import com.facebook.thrift.async.*;
import com.facebook.thrift.meta_data.*;
import com.facebook.thrift.server.*;
import com.facebook.thrift.transport.*;
import com.facebook.thrift.protocol.*;

@SuppressWarnings({ "unused", "serial" })
public class MyStruct implements TBase, java.io.Serializable, Cloneable {
  private static final TStruct STRUCT_DESC = new TStruct("MyStruct");
  private static final TField FIELD_FIELD_DESC = new TField("field", TType.I32, (short)1);
  private static final TField SET_STRING_FIELD_DESC = new TField("set_string", TType.SET, (short)2);

  public final Integer field;
  public final Set<String> set_string;
  public static final int FIELD = 1;
  public static final int SET_STRING = 2;

  public MyStruct(
      Integer field,
      Set<String> set_string) {
    this.field = field;
    this.set_string = set_string;
  }

  /**
   * Performs a deep copy on <i>other</i>.
   */
  public MyStruct(MyStruct other) {
    if (other.isSetField()) {
      this.field = TBaseHelper.deepCopy(other.field);
    } else {
      this.field = null;
    }
    if (other.isSetSet_string()) {
      this.set_string = TBaseHelper.deepCopy(other.set_string);
    } else {
      this.set_string = null;
    }
  }

  public MyStruct deepCopy() {
    return new MyStruct(this);
  }

  public Integer getField() {
    return this.field;
  }

  // Returns true if field field is set (has been assigned a value) and false otherwise
  public boolean isSetField() {
    return this.field != null;
  }

  public Set<String> getSet_string() {
    return this.set_string;
  }

  // Returns true if field set_string is set (has been assigned a value) and false otherwise
  public boolean isSetSet_string() {
    return this.set_string != null;
  }

  @Override
  public boolean equals(Object _that) {
    if (_that == null)
      return false;
    if (this == _that)
      return true;
    if (!(_that instanceof MyStruct))
      return false;
    MyStruct that = (MyStruct)_that;

    if (!TBaseHelper.equalsNobinary(this.isSetField(), that.isSetField(), this.field, that.field)) { return false; }

    if (!TBaseHelper.equalsNobinary(this.isSetSet_string(), that.isSetSet_string(), this.set_string, that.set_string)) { return false; }

    return true;
  }

  @Override
  public int hashCode() {
    return Arrays.deepHashCode(new Object[] {field, set_string});
  }

  // This is required to satisfy the TBase interface, but can't be implemented on immutable struture.
  public void read(TProtocol iprot) throws TException {
    throw new TException("unimplemented in android immutable structure");
  }

  public static MyStruct deserialize(TProtocol iprot) throws TException {
    Integer tmp_field = null;
    Set<String> tmp_set_string = null;
    TField __field;
    iprot.readStructBegin();
    while (true)
    {
      __field = iprot.readFieldBegin();
      if (__field.type == TType.STOP) {
        break;
      }
      switch (__field.id)
      {
        case FIELD:
          if (__field.type == TType.I32) {
            tmp_field = iprot.readI32();
          } else {
            TProtocolUtil.skip(iprot, __field.type);
          }
          break;
        case SET_STRING:
          if (__field.type == TType.SET) {
            {
              TSet _set54 = iprot.readSetBegin();
              tmp_set_string = new HashSet<String>(Math.max(0, 2*_set54.size));
              for (int _i55 = 0; 
                   (_set54.size < 0) ? iprot.peekSet() : (_i55 < _set54.size); 
                   ++_i55)
              {
                String _elem56;
                _elem56 = iprot.readString();
                tmp_set_string.add(_elem56);
              }
              iprot.readSetEnd();
            }
          } else {
            TProtocolUtil.skip(iprot, __field.type);
          }
          break;
        default:
          TProtocolUtil.skip(iprot, __field.type);
          break;
      }
      iprot.readFieldEnd();
    }
    iprot.readStructEnd();

    MyStruct _that;
    _that = new MyStruct(
      tmp_field
      ,tmp_set_string
    );
    _that.validate();
    return _that;
  }

  public void write(TProtocol oprot) throws TException {
    validate();

    oprot.writeStructBegin(STRUCT_DESC);
    if (this.field != null) {
      oprot.writeFieldBegin(FIELD_FIELD_DESC);
      oprot.writeI32(this.field);
      oprot.writeFieldEnd();
    }
    if (this.set_string != null) {
      oprot.writeFieldBegin(SET_STRING_FIELD_DESC);
      {
        oprot.writeSetBegin(new TSet(TType.STRING, this.set_string.size()));
        for (String _iter57 : this.set_string)        {
          oprot.writeString(_iter57);
        }
        oprot.writeSetEnd();
      }
      oprot.writeFieldEnd();
    }
    oprot.writeFieldStop();
    oprot.writeStructEnd();
  }

  @Override
  public String toString() {
    return toString(1, true);
  }

  @Override
  public String toString(int indent, boolean prettyPrint) {
    return TBaseHelper.toStringHelper(this, indent, prettyPrint);
  }

  public void validate() throws TException {
    // check for required fields
  }

}
