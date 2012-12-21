echo -e "\033[1;31mgithub.com/jakeasmith/Developer-Tool-Kit"

# Initilize the subs
eval "$(~/.tk/bin/tk init -)"
eval "$(~/.tk/bin/tkc init -)"
eval "$(~/.tk/bin/tki init -)"

# Colors
alias ls='ls -lsaG'

# Add the bin
export PATH=$PATH:~/.tk/bin

# Add git shortcuts
alias gco='git co'
alias gci='git ci'
alias grb='git rb'

# Show git branches in bash prompt
. ~/.tk/etc/term/prompt

# git completion
. ~/.tk/etc/term/git-completion

# Set default editor
export EDITOR=$(tk config editor)

##
## And, eventually..
##

# Add aliases for projects