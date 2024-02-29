FROM node:14

WORKDIR /app

COPY vue/package.json .

RUN npm install

COPY vue .

EXPOSE 8080

CMD [ "npm", "run", "serve" ]
