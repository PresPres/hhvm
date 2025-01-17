/* $Id$ */
#pragma once

#include <stdint.h>
typedef unsigned char u_char;

#define MD5_HASH_MAX_LEN 120

struct php_crypt_extended_data {
  int initialized;
  uint32_t saltbits;
  uint32_t old_salt;
  uint32_t en_keysl[16], en_keysr[16];
  uint32_t de_keysl[16], de_keysr[16];
  uint32_t old_rawkey0, old_rawkey1;
  char output[21];
};

/*
 * _crypt_extended_init() must be called explicitly before first use of
 * _crypt_extended_r().
 */

void _crypt_extended_init(void);

char *_crypt_extended_r(const char *key, const char *setting,
  struct php_crypt_extended_data *data);
