ARG IMAGE=node:20-alpine
ARG GIT_REV=develop

# Base
FROM ${IMAGE} AS base
RUN apk --no-cache add dumb-init
RUN npm install --global npm@latest foreman@latest
RUN mkdir -p /app && chown -R node:node /app
WORKDIR /app
USER node

# Build
FROM base AS build
COPY --chown=node:node package*.json .
RUN npm install
COPY --chown=node:node . .
RUN npm run build

# Runner
FROM base AS runner
ENV NODE_ENV=production
ENV PORT=5000
ENV HOST=0.0.0.0
ENV PATH $PATH:/app/node_modules/.bin
COPY --chown=node:node ./package*.json ./
COPY --chown=node:node --from=build /app/node_modules ./node_modules
RUN npm install --omit=dev
COPY --chown=node:node --from=build /app/build .
COPY --chown=node:node --from=build /app/Procfile .
EXPOSE 5000
ENTRYPOINT ["/usr/bin/dumb-init", "--", "nf", "start"]
CMD ["--help"]
