if [[ ! -o interactive ]]; then
    return
fi

compctl -K _tk tk

_tk() {
  local word words completions
  read -cA words
  word="${words[2]}"

  if [ "${#words}" -eq 2 ]; then
    completions="$(tk commands)"
  else
    completions="$(tk completions "${word}")"
  fi

  reply=("${(ps:\n:)completions}")
}
