pipeline {
    agent any

    options {
        timestamps()
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
