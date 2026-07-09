import { App, Duration, RemovalPolicy, Stack } from 'aws-cdk-lib';
import * as events from 'aws-cdk-lib/aws-events';
import * as targets from 'aws-cdk-lib/aws-events-targets';
import * as lambda from 'aws-cdk-lib/aws-lambda';
import * as s3 from 'aws-cdk-lib/aws-s3';
import * as sqs from 'aws-cdk-lib/aws-sqs';
import * as sfn from 'aws-cdk-lib/aws-stepfunctions';
import { Construct } from 'constructs';

// Cole Stack
class ColeMarshallStack extends Stack {
	constructor(scope: Construct, id: string) {
		super(scope, id, {
			description: 'Cole Marshall, deployed as cloud infrastructure',
			env: { region: 'us-east-2' }, // Closest region to Madison, WI
		});

		// Brain
		const brain = new lambda.Function(this, 'Brain', {
			runtime: lambda.Runtime.NODEJS_22_X,
			handler: 'index.think',
			memorySize: 1024,
			code: lambda.Code.fromInline('exports.think = async (idea) => "I\'ll see what I can do!";'),
		});

		// Memories, retained
		const memories = new s3.Bucket(this, 'Memories', {
			versioned: true,
			removalPolicy: RemovalPolicy.RETAIN,
		});
		memories.grantReadWrite(brain);

		// Heart, keeps the brain warm
		new events.Rule(this, 'Heart', {
			schedule: events.Schedule.rate(Duration.minutes(5)),
			targets: [new targets.LambdaFunction(brain)],
		});

		// Arms, carry the payloads
		for (const side of ['Left', 'Right'] as const) {
			new sqs.Queue(this, `${side}Arm`);
		}

		// Legs, one foot in front of the other
		new sfn.StateMachine(this, 'Legs', {
			definitionBody: sfn.DefinitionBody.fromChainable(
				new sfn.Pass(this, 'LeftFoot').next(new sfn.Pass(this, 'RightFoot')),
			),
		});
	}
}

// Deploy Cole
new ColeMarshallStack(new App(), 'ColeMarshall');
