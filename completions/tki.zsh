if [[ ! -o interactive ]]; then
    return
fi

compctl -K _tki tki

_tki() {
  local word words completions
  read -cA words
  word="${words[2]}"

  if [ "${#words}" -eq 2 ]; then
    completions="$(tki commands)"
  else
    completions="$(tki completions "${word}")"
  fi

  reply=("${(ps:\n:)completions}")
}
