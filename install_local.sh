#!/bin/bash

REPO_DIR=/Users/lcigler/Documents/Personal/Dev/phusis
INSTALL_DIR=/Users/lcigler/Documents/Personal/Dev/htdocs/phusis_ch

# Which site version to copy? (philosophie, animations, steve, phusis)
SITE=$1

# Copy templates
for THEME_DIR in "${REPO_DIR}"/wp-content/themes/*
do
  THEME_NAME=`basename "${THEME_DIR}"`
  THEME_INSTALL_DIR="${INSTALL_DIR}/wp-content/themes/${THEME_NAME}"
  mkdir "${THEME_INSTALL_DIR}"
  cp "${THEME_DIR}/"*.* "${THEME_INSTALL_DIR}"
  cp -R "${THEME_DIR}/images" "${THEME_INSTALL_DIR}"

  if [ ! -z "${SITE}" ]; then
    cp "${THEME_DIR}/${SITE}/"*.* "${INSTALL_DIR}/wp-content/themes/${THEME_NAME}"
  fi
done

# Copy plugins
for PLUGIN_DIR in "${REPO_DIR}"/wp-content/plugins/*
do
  PLUGIN_NAME=`basename "${PLUGIN_DIR}"`
  cp -R "${PLUGIN_DIR}"/* "${INSTALL_DIR}/wp-content/plugins/${PLUGIN_NAME}/"
done

# Copy extensions
cp -R "${REPO_DIR}/wp-content/extensions/"* "${INSTALL_DIR}/wp-content/extensions/"
