(*
 * Copyright (c) 2015, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the "hack" directory of this source tree.
 *
 *)

open Reordered_argument_collections

module S : sig
  type t = private string [@@deriving show]

  val equal : t -> t -> bool

  val compare : t -> t -> int

  val to_string : t -> string
end

type t = S.t [@@deriving show]

val dummy_path : t

val make : string -> t

val make_unsafe : string -> t

val to_string : t -> string

val file_exists : t -> bool

val is_directory : t -> bool

val equal : t -> t -> bool

val compare : t -> t -> int

(** [concat p1 p2] returns a path equivalent to [p1 ^ "/" ^ p2].
  In the resulting path [p1] (resp. [p2]) has all its trailing (resp. leading) "." and "/" removed.
  eg: concat "a/." ".//b" => "a/b" concat "." "b" => "./b" concat "a" "." => "a/." concat "a" "/b" => "a/b" *)
val concat : t -> string -> t

val chdir : t -> unit

val dirname : t -> t

val basename : t -> string

val getcwd : unit -> t

val output : out_channel -> t -> unit

val remove : t -> unit

val parent : t -> t

val executable_name : t

val cat : t -> string

val slash_escaped_string_of_path : t -> string

val path_of_slash_escaped_string : string -> t

module Set : module type of Reordered_argument_set (Set.Make (S))
