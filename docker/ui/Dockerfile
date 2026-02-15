FROM node:20-alpine

WORKDIR /app

COPY package.json package-lock.json* ./

RUN npm install

CMD ["npx", "vite", "--host", "0.0.0.0"]
