
sed -r -i -e "s/archive.ubuntu.com/mirrors.163.com/g" /etc/apt/sources.list
sed -r -i -e "s/security.ubuntu.com/mirrors.163.com/g" /etc/apt/sources.list

apt-get -y update && apt-get -y upgrade

apt-get remove docker docker-engine docker.io

cd /usr/local/src

apt-get -y install \
    apt-transport-https \
    ca-certificates \
    curl \
    software-properties-common

curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -

apt-key fingerprint 0EBFCD88

add-apt-repository \
   "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
   $(lsb_release -cs) \
   stable"

apt-get -y update && apt-get -y upgrade

apt-get -y install docker-ce

docker run hello-world

