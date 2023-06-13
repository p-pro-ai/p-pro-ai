import React, { useState } from 'react';
import { View, TextInput, Button, Alert, StyleSheet, Text, Image, ScrollView } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';


const Verification = ({ navigation, route }) => {
    const [verificationcode, setVerificationCode] = useState('');

    const handleVerification = () => {
        const email = route.params.email; // accessing email
        
        fetch('https://p-pro.eu/api/register.php?action=verify', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username: email, code: verificationcode })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Save user data and token in AsyncStorage
                AsyncStorage.setItem('userToken', data.token);
                navigation.replace('Dashboard');
            } else {
                Alert.alert('Error', data.error);
            }
        });
    };

    return (
        <ScrollView style={styles.container}>
             <View style={styles.logoContainer}>
                <Image
                    style={styles.logo}
                    source={require('../../assets/logo.png')}
                />
            </View>
            <Text style={styles.textContainer} >Verification code: </Text>
            <TextInput
                value={verificationcode}
                onChangeText={(text) => setVerificationCode(text)}
                placeholder={'Verification code'}
                style={styles.input}
                placeholderTextColor="#575757"
            />
            <Button
                title={'Register'}
                onPress={handleVerification}
            />
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

export default Verification;
