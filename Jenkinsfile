pipeline {
    agent any

    options {
        timestamps()
    }

    environment {
        COMPOSER_HOME = credentials("COMPOSER_HOME")
        COMPOSER_CACHE_DIR = credentials("COMPOSER_CACHE_DIR")
        POSTGRES_HOST = credentials("POSTGRES_HOST")
        POSTGRES_DB = credentials("POSTGRES_DB")
        POSTGRES_USER = credentials("POSTGRES_USER")
        POSTGRES_PASSWORD = credentials("POSTGRES_PASSWORD")
    }

    stages {
        stage("Init") {
            steps {
                sh "make build"
            }
        }
        stage("Lint") {
            steps {
                sh "make lint"
            }
        }
        stage("Test") {
            steps {
                sh "make test"
            }
        }
        stage("Down") {
            steps {
                sh "make down"
            }
        }
    }
}
