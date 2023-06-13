import React, { useState } from 'react';
import { View, TextInput, Button, Alert, StyleSheet, Text, Image, ScrollView } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
const validateEmail = (email) => {
    const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return re.test(email);
};

const Login = ({ navigation }) => {
    const [password, setPassword] = useState('');
    const [email, setEmail] = useState('');

    const handleLogin = () => {
        if (!email || !password) {
            Alert.alert('Error', 'Both fields are required!');
            return;
        }
    
        if (!validateEmail(email)) {
            Alert.alert('Error', 'Email is not valid!');
            return;
        }
        fetch('https://p-pro.eu/api/login.php', {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                username: email,
                password: password
            })
        })
        .then((response) => response.json())
        .then((json) => {
            if (json.success) {
                // Handle successful login
                //Alert.alert('Success', 'You have successfully logged in!');
                
                // Save JWT to AsyncStorage
                AsyncStorage.setItem('userToken', json.token);
                navigation.replace('Dashboard');
            } else {
                // Handle login error
                Alert.alert('Error', json.error);
            }
        })
        .catch((error) => {
            console.error(error);
            Alert.alert('Error', 'Something went wrong!');
        });
    };
    

    const handleRegister = () => {
        navigation.navigate('Register');
    };

    const handleForgotPassword = () => {
        // Implement your logic for handling the forgotten password action
        Alert.alert("Expect this feature soon", "We are sorry, this feature is currently unavailable. If you forgot your password, please contact us at support@p-pro.eu");
    };

    return (
        <ScrollView style={styles.container}>
             <View style={styles.logoContainer}>
                <Image
                    style={styles.logo}
                    source={require('../../assets/logo.png')}
                />
            </View>
            <Text style={styles.textContainer} >Email: </Text>
            <TextInput
                placeholderTextColor="#575757"
                value={email}
                onChangeText={(text) => setEmail(text)}
                placeholder={'Email'}
                style={styles.input}
            />
            <Text style={styles.textContainer} >Password: </Text>
            <TextInput
                placeholderTextColor="#575757"
                value={password}
                onChangeText={(text) => setPassword(text)}
                placeholder={'Password'}
                secureTextEntry={true}
                style={styles.input}
            />
            <Button
                title={'Login'}
                 onPress={handleLogin}
            />

            <View style={styles.additionalLinks}>
            <View>
                    <Text style={styles.linkText} onPress={handleRegister}>
                        Don't have an account? Register!
                    </Text>
                </View>
                <View>
                    <Text style={styles.linkText} onPress={handleForgotPassword}>
                        Forgotten Password?
                    </Text>
                </View>
            </View>
        </ScrollView>
    );
};

const styles = StyleSheet.create({
    container: {
        flex: 1,
        paddingHorizontal: 15
    },
    logoContainer: {
        width: '100%',  // Take up full width of the container
        alignItems: 'center',  // Center children horizontally
    },
    logo: {
        width: '80%',
        height: undefined,
        aspectRatio: 1,
        resizeMode: 'contain',
        marginBottom: 20,
    },
    textContainer: {
        color: 'black',
        marginBottom: 5,
    },
    input: {
        height: 40,
        borderColor: 'gray',
        borderWidth: 1,
        marginBottom: 10,
        paddingHorizontal: 8,
        borderRadius: 5,
        color: 'black',
    },
    additionalLinks: {
        marginTop: 20,
        flexDirection: 'column',
        alignItems: 'flex-end',
    },
    linkText: {
        color: 'blue',
        textDecorationLine: 'underline',
    },
});

export default Login;
