if [[ ! -o interactive ]]; then
    return
fi

compctl -K _tkc tkc

_tkc() {
  local word words completions
  read -cA words
  word="${words[2]}"

  if [ "${#words}" -eq 2 ]; then
    completions="$(tkc commands)"
  else
    completions="$(tkc completions "${word}")"
  fi

  reply=("${(ps:\n:)completions}")
}
