import React, { useState, useEffect, useRef } from 'react';
import {
  View,
  Text,
  StyleSheet,
  TextInput,
  Button,
  FlatList,
  KeyboardAvoidingView,
  Platform,
  TouchableOpacity,
  ActivityIndicator,
  Linking
} from 'react-native';
import { SvgXml } from 'react-native-svg';
import AsyncStorage from '@react-native-async-storage/async-storage';
const broom = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M566.6 54.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192-34.7-34.7c-4.2-4.2-10-6.6-16-6.6c-12.5 0-22.6 10.1-22.6 22.6v29.1L364.3 320h29.1c12.5 0 22.6-10.1 22.6-22.6c0-6-2.4-11.8-6.6-16l-34.7-34.7 192-192zM341.1 353.4L222.6 234.9c-42.7-3.7-85.2 11.7-115.8 42.3l-8 8C76.5 307.5 64 337.7 64 369.2c0 6.8 7.1 11.2 13.2 8.2l51.1-25.5c5-2.5 9.5 4.1 5.4 7.9L7.3 473.4C2.7 477.6 0 483.6 0 489.9C0 502.1 9.9 512 22.1 512l173.3 0c38.8 0 75.9-15.4 103.4-42.8c30.6-30.6 45.9-73.1 42.3-115.8z"/></svg>`;
const GPT35 = ({ navigation }) => {
  useEffect(() => {
    navigation.setOptions({
        headerRight: () => (
            <TouchableOpacity onPress={clearChat}>
                <SvgXml xml={broom} width="24" height="24" />
            </TouchableOpacity>
        )
    });
}, [navigation]);

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
                const userEmail = await AsyncStorage.getItem('userEmail');
                
                // Verify user data with your API
                fetch('https://p-pro.eu/api/token_verify.php', {
                    method: 'POST',
                    headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        username: userEmail,
                        token: userToken
                    })
                })
                .then(response => response.json())
                .then(json => {
                    if (!json.success) {
                        // If the server responds with failure, redirect to login
                        navigation.replace('Login');
                    }else{
                        console.log(json.email_addr);
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

    const generateChatSessionId = () => {
        return Math.floor(Math.random() * 900000000000) + 100000000000;
    }

    const [messages, setMessages] = useState([]);
    const [inputMessage, setInputMessage] = useState('');
    const [chatSessionId, setChatSessionId] = useState(generateChatSessionId());
    const [isGenerating, setIsGenerating] = useState(false);
    const flatListRef = useRef();

    useEffect(() => {
        addMessage("Hello! I am ALLIN GPT 3.5 chat! How may I assist you today?", 'bot');
    }, []);

    const addMessage = (content, sender) => {
        setMessages(prevMessages => [...prevMessages, { content, sender }]);
    }

    console.log(userEmail_secure);

    const sendMessage = () => {
        const messageToSend = inputMessage;
        addMessage(messageToSend, 'user');
        setInputMessage('');
        setIsGenerating(true);

        fetch('https://p-pro.eu/api/gpt35.php/', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                input: messageToSend,
                session_id: chatSessionId,
                email_addr: userEmail_secure,
            }),
        })
        .then((response) => response.json())
        .then((data) => {
            setIsGenerating(false);
            if (data.needupgrade) {
                addMessage(data.message, 'bot');
              setShowWeb(true);
            } else {
              addMessage(data.message, 'bot');
            }
          })
          .catch((error) => {
            setIsGenerating(false);
            console.error('Error:', error);
          });
      };
    
      const clearChat = () => {
        setChatSessionId(generateChatSessionId());
        setMessages([{ content: "Hello! I am ALLIN GPT 3.5 chat! How may I assist you today?", sender: 'bot' }]);
      }
    
      const renderItem = ({ item }) => (
        <View style={styles.messageContainer(item.sender)}>
          <Text style={styles.messageText(item.sender)}>{item.content}</Text>
        </View>
      )
    
      const handleInputChange = (text) => {
        setInputMessage(text);
      }; 
      return (
        <View style={styles.container}>
          <FlatList
            ref={flatListRef}
            data={messages}
            renderItem={renderItem}
            keyExtractor={(item, index) => index.toString()}
            onContentSizeChange={() => {
              if (messages.length > 0) {
                flatListRef.current.scrollToEnd({ animated: true });
              }
            }}
          />
          {isGenerating && <Text style={styles.typingText}>Typing...</Text>}
          <KeyboardAvoidingView behavior={Platform.OS === 'ios' ? 'padding' : 'height'}>
            <View style={styles.inputContainer}>
              <TextInput
              placeholderTextColor="#575757"
                style={styles.input}
                placeholder='Type your message here...'
                value={inputMessage}
                onChangeText={handleInputChange}
              />
              <TouchableOpacity onPress={sendMessage} style={styles.sendChatButton}>
                <Text style={styles.buttonText}>Send</Text>
              </TouchableOpacity>
            </View>
          </KeyboardAvoidingView>
        </View>
      );
    }
    
    const styles = StyleSheet.create({
        clearChatButton: {
            backgroundColor: 'grey',
            padding: 10,
            alignItems: 'center',
            marginLeft: 10,
          },
          sendChatButton: {
            backgroundColor: '#00AEFF',
            padding: 10,
            alignItems: 'center',
          },
          buttonText: {
            color: 'white',
            fontSize: 16,
          },
      container: {
        flex: 1,
        padding: 10,
      },
      messageContainer: sender => ({
        alignSelf: sender === 'bot' ? 'flex-start' : 'flex-end',
        backgroundColor: sender === 'bot' ? '#ddd' : '#007aff',
        borderRadius: 20,
        marginTop: 10,
        padding: 10,
        maxWidth: '80%',
      }),
      messageText: sender => ({
        color: sender === 'bot' ? '#000' : '#fff',
      }),
      inputContainer: {
        flexDirection: 'row',
        marginTop: 10,
      },
      input: {
        flex: 1,
        borderColor: '#ccc',
        borderWidth: 1,
        borderRadius: 20,
        padding: 10,
        marginRight: 10,
        color: 'black',
      },
      clearChatButtonContainer: {
        marginTop: 10,
      },
      typingText: {
        margin: 10,
        fontStyle: 'italic',
        color: "#000",
      },
    });
    
    export default GPT35;
  