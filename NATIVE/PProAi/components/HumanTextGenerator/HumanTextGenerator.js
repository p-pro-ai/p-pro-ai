import React, { useState, useEffect } from 'react';
import { View, Text, TextInput, Button, StyleSheet, ScrollView, ActivityIndicator, Linking } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';

const TextGenerator = ({ navigation }) => {
    const openInBrowser = async () => {
        const url = `https://p-pro.eu/ai/pricing_key.php?key=${userToken}`;
      
        try {
          await Linking.openURL(url);
        } catch (error) {
          console.error('Failed to open URL:', error);
        }
      };

      const [userEmail_secure, setUserEmail_secure] = useState(null);
  const [showWeb, setShowWeb] = useState(false);
  const [userToken, setUserToken] = useState(null);
  useEffect(() => {
    if (showWeb) {
      openInBrowser();
    }
  }, [showWeb]);

    useEffect(() => {
        const verifyToken = async () => {
          try {
            const userToken = await AsyncStorage.getItem('userToken');
            setUserToken(userToken);

              // Verify user data with your API
              fetch('https://p-pro.eu/api/token_verify.php', {
                method: 'POST',
                headers: {
                  Accept: 'application/json',
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                  token: userToken
                })
              })
                .then(response => response.json())
                .then(json => {
                  if (!json.success) {
                    // If the server responds with failure, redirect to login
                    navigation.replace('Login');
                  }else{
                    setUserEmail_secure(json.email_addr);
                  }
                })
                .catch(error => {
                  console.error(error);
                  // Handle error if needed
                });
            
          } catch (error) {
            console.error(error);
            // Handle error if needed
          }
        };
    
        verifyToken();
      }, []);

  const [inputMessage, setInputMessage] = useState('');
  const [generatedText, setGeneratedText] = useState('');
  const [typeText, setTypeText] = useState('');
  const [wordCount, setWordCount] = useState('');
  const [language, setLanguage] = useState('');
  const [isLoading, setIsLoading] = useState(false);

  const sendMessage = () => {
    setIsLoading(true);

    fetch('https://p-pro.eu/api/humangenerator.php/', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        input: inputMessage,
        type: typeText,
        word_count: wordCount,
        language: language,
        email_addr: userEmail_secure,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        
        //setInputMessage(''); // Clear the input message after sending
        if (data.needupgrade) {
            setGeneratedText(data.message);
          setShowWeb(true);
        } else {
            setGeneratedText(data.message);
        }
      })
      .catch((error) => {
        console.error('Error:', error);
      })
      .finally(() => {
        setIsLoading(false);
      });
  };

  return (
    <ScrollView style={styles.container}>
      <ScrollView style={styles.textArea}>
      <Text style={styles.generatedText}>{generatedText}</Text>
      </ScrollView>
      <TextInput style={styles.textInput} placeholder='Enter your task here' onChangeText={setInputMessage} value={inputMessage} placeholderTextColor="#575757"/>
      <View style={styles.inputRow}>
        <Text style={styles.label}>Type (Essay, ...): </Text>
        <TextInput style={styles.textInput} onChangeText={setTypeText} placeholderTextColor="#575757"/>
      </View>
      <View style={styles.inputRow}>
        <Text style={styles.label}>Word count: </Text>
        <TextInput style={styles.textInput} onChangeText={setWordCount} placeholderTextColor="#575757"/>
      </View>
      <View style={styles.inputRow}>
        <Text style={styles.label}>Language: </Text>
        <TextInput style={styles.textInput} onChangeText={setLanguage} placeholderTextColor="#575757"/>
      </View>
      <Button title='Generate Text' onPress={sendMessage} disabled={isLoading} />
      {isLoading && <ActivityIndicator size="large" color="#0000ff" />}
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    padding: 10,
    backgroundColor: '#fff',
  },
  textArea: {
    height: 300,
    borderColor: '#ccc',
    borderWidth: 1,
    //padding: 10,
    marginBottom: 10,
    color: '#000',
  },
  textInput: {
    flex: 1,
    borderColor: '#ccc',
    borderWidth: 1,
    padding: 10,
    marginTop: 10,
    color: '#000',
  },
  generatedText: {
    color: '#000',
  },
  inputRow: {
    flexDirection: 'row',
    alignItems: 'center',
    marginBottom: 10,
  },
  label: {
    fontWeight: '600',
    marginRight: 10,
    color: '#000',
},
});

export default TextGenerator;