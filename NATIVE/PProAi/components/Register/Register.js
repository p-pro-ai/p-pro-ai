import React, { useState } from 'react';
import { View, TextInput, Button, Alert, StyleSheet, Text, Image, ScrollView } from 'react-native';
const validateEmail = (email) => {
    const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return re.test(email);
};
const Register = ({ navigation }) => {
    const [password, setPassword] = useState('');
    const [email, setEmail] = useState('');
    const [persname, setName] = useState('');

    const handleRegister = () => {
        if (!persname || !email || !password) {
            Alert.alert('Error', 'All fields are required!');
            return;
        }
    
        if (!validateEmail(email)) {
            Alert.alert('Error', 'Email is not valid!');
            return;
        }
        fetch('https://p-pro.eu/api/register.php?action=register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username: email, password: password, fullname: persname })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                navigation.navigate('Verification_code', { email });
            } else {
                Alert.alert('Error', data.error);
            }
        })
        .catch(error => {
            console.error(error);
            Alert.alert('Error', 'Something went wrong!');
        });
    };


    const handleLogin = () => {
        navigation.navigate('Login');
    };


    return (
        <ScrollView style={styles.container}>
             <View style={styles.logoContainer}>
                <Image
                    style={styles.logo}
                    source={require('../../assets/logo.png')}
                />
            </View>
            <Text style={styles.textContainer} >Name: </Text>
            <TextInput
                value={persname}
                onChangeText={(text) => setName(text)}
                placeholder={'Name'}
                style={styles.input}
                placeholderTextColor="#575757"
            />
            <Text style={styles.textContainer} >Email: </Text>
            <TextInput
                value={email}
                onChangeText={(text) => setEmail(text)}
                placeholder={'Email'}
                style={styles.input}
                placeholderTextColor="#575757"
            />
            <Text style={styles.textContainer} >Password: </Text>
            <TextInput
                value={password}
                onChangeText={(text) => setPassword(text)}
                placeholder={'Password'}
                secureTextEntry={true}
                style={styles.input}
                placeholderTextColor="#575757"
            />
            <Button
                title={'Next'}
                onPress={handleRegister}
            />

            <View style={styles.additionalLinks}>
                <View>
                    <Text style={styles.linkText} onPress={handleLogin}>
                        Already have an account? Log in!
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

export default Register;
